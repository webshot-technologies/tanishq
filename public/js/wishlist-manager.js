/**
 * Advanced Wishlist Management System
 * Handles localStorage persistence with server-side synchronization
 * Provides cross-device consistency with local fallback
 */

class WishlistManager {
    constructor(options = {}) {
        this.userId = options.userId || null;
        this.idToken = options.idToken || null;
        this.syncEndpoint = options.syncEndpoint || '/wishlist/sync';
        this.localStorageKey = 'wishlist';
        this.lastSyncKey = 'wishlist_last_sync';
        this.syncInterval = options.syncInterval || 300000; // 5 minutes default
        
        // Initialize wishlist data
        this.localWishlist = {};
        this.serverWishlist = [];
        this.lastSyncTime = 0;
        
        // Initialize
        this.init();
    }

    /**
     * Initialize the wishlist manager
     */
    async init() {
        this.loadLocalWishlist();
        this.loadLastSyncTime();
        
        // Only sync if user is authenticated
        if (this.userId && this.idToken) {
            await this.syncWithServer();
            this.startPeriodicSync();
        }
    }

    /**
     * Load wishlist from localStorage
     */
    loadLocalWishlist() {
        try {
            const stored = localStorage.getItem(this.localStorageKey);
            this.localWishlist = stored ? JSON.parse(stored) : {};
        } catch (e) {
            console.warn('Failed to load wishlist from localStorage:', e);
            this.localWishlist = {};
        }
    }

    /**
     * Save wishlist to localStorage
     */
    saveLocalWishlist() {
        try {
            localStorage.setItem(this.localStorageKey, JSON.stringify(this.localWishlist));
        } catch (e) {
            console.warn('Failed to save wishlist to localStorage:', e);
        }
    }

    /**
     * Load last sync time from localStorage
     */
    loadLastSyncTime() {
        try {
            const stored = localStorage.getItem(this.lastSyncKey);
            this.lastSyncTime = stored ? parseInt(stored, 10) : 0;
        } catch (e) {
            this.lastSyncTime = 0;
        }
    }

    /**
     * Save last sync time to localStorage
     */
    saveLastSyncTime() {
        try {
            localStorage.setItem(this.lastSyncKey, this.lastSyncTime.toString());
        } catch (e) {
            console.warn('Failed to save last sync time:', e);
        }
    }

    /**
     * Sync with server-side wishlist
     */
    async syncWithServer() {
        if (!this.userId || !this.idToken) {
            console.warn('Cannot sync: user not authenticated');
            return false;
        }

        try {
            const response = await fetch(this.syncEndpoint, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + this.idToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            });

            if (!response.ok) {
                throw new Error(`Sync failed: ${response.status}`);
            }

            const data = await response.json();
            
            if (data.success && Array.isArray(data.wishlist_skus)) {
                this.serverWishlist = data.wishlist_skus;
                this.lastSyncTime = data.timestamp || Date.now();
                
                // Merge server data with local data
                this.mergeWishlists();
                
                this.saveLastSyncTime();
                console.log('Wishlist synced successfully:', this.serverWishlist.length, 'items');
                return true;
            }
            
            return false;
        } catch (error) {
            console.warn('Wishlist sync failed:', error);
            return false;
        }
    }

    /**
     * Merge server wishlist with local wishlist
     * Server data takes precedence for consistency across devices
     */
    mergeWishlists() {
        // Create a new merged wishlist
        const mergedWishlist = {};
        
        // Add all server items
        this.serverWishlist.forEach(sku => {
            mergedWishlist[sku] = true;
        });
        
        // Add local items that might not have synced yet
        // These will be synced on next add/remove operation
        Object.keys(this.localWishlist).forEach(sku => {
            if (this.localWishlist[sku] === true) {
                mergedWishlist[sku] = true;
            }
        });
        
        this.localWishlist = mergedWishlist;
        this.saveLocalWishlist();
    }

    /**
     * Start periodic synchronization
     */
    startPeriodicSync() {
        if (this.syncIntervalId) {
            clearInterval(this.syncIntervalId);
        }
        
        this.syncIntervalId = setInterval(() => {
            this.syncWithServer();
        }, this.syncInterval);
    }

    /**
     * Stop periodic synchronization
     */
    stopPeriodicSync() {
        if (this.syncIntervalId) {
            clearInterval(this.syncIntervalId);
            this.syncIntervalId = null;
        }
    }

    /**
     * Check if an item is in the wishlist
     */
    isInWishlist(sku) {
        return this.localWishlist[sku] === true;
    }

    /**
     * Get all wishlist SKUs
     */
    getWishlistSkus() {
        return Object.keys(this.localWishlist).filter(sku => this.localWishlist[sku] === true);
    }

    /**
     * Add item to wishlist (optimistic update)
     */
    addToWishlist(sku) {
        this.localWishlist[sku] = true;
        this.saveLocalWishlist();
        this.triggerWishlistUpdateEvent('add', sku);
    }

    /**
     * Remove item from wishlist (optimistic update)
     */
    removeFromWishlist(sku) {
        delete this.localWishlist[sku];
        this.saveLocalWishlist();
        this.triggerWishlistUpdateEvent('remove', sku);
    }

    /**
     * Handle API response after add/remove operation
     */
    handleApiResponse(sku, action, success) {
        if (!success) {
            // Revert optimistic update on failure
            if (action === 'add') {
                delete this.localWishlist[sku];
            } else if (action === 'remove') {
                this.localWishlist[sku] = true;
            }
            this.saveLocalWishlist();
            this.triggerWishlistUpdateEvent('revert', sku);
        }
    }

    /**
     * Trigger custom wishlist update events
     */
    triggerWishlistUpdateEvent(action, sku) {
        const event = new CustomEvent('wishlistUpdate', {
            detail: {
                action: action,
                sku: sku,
                isInWishlist: this.isInWishlist(sku),
                totalItems: this.getWishlistSkus().length
            }
        });
        
        document.dispatchEvent(event);
    }

    /**
     * Get wishlist statistics
     */
    getStats() {
        return {
            totalItems: this.getWishlistSkus().length,
            lastSyncTime: this.lastSyncTime,
            hasServerSync: this.userId && this.idToken,
            serverItems: this.serverWishlist.length
        };
    }

    /**
     * Force immediate sync
     */
    async forcSync() {
        return await this.syncWithServer();
    }

    /**
     * Clear all wishlist data (useful for logout)
     */
    clear() {
        this.localWishlist = {};
        this.serverWishlist = [];
        this.lastSyncTime = 0;
        this.stopPeriodicSync();
        
        try {
            localStorage.removeItem(this.localStorageKey);
            localStorage.removeItem(this.lastSyncKey);
        } catch (e) {
            console.warn('Failed to clear localStorage:', e);
        }
    }

    /**
     * Update authentication details (useful after token refresh)
     */
    updateAuth(userId, idToken) {
        this.userId = userId;
        this.idToken = idToken;
        
        if (this.userId && this.idToken) {
            this.syncWithServer();
            this.startPeriodicSync();
        } else {
            this.stopPeriodicSync();
        }
    }
}

// Global wishlist manager instance
window.wishlistManager = null;

/**
 * Initialize global wishlist manager
 */
function initWishlistManager(options) {
    if (!window.wishlistManager) {
        window.wishlistManager = new WishlistManager(options);
    }
    return window.wishlistManager;
}

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { WishlistManager, initWishlistManager };
}