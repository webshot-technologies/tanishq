#!/usr/bin/env python3
import requests
import os
from urllib.parse import urlparse
import time

# Create the output directory
output_dir = "public/image/bystate"
os.makedirs(output_dir, exist_ok=True)

# Image mapping from the Google doc
image_data = {
    "Telugu Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/telugu-bride.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Gujarati Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Gujarati/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Tamil Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/kannadiga-gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Marathi Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Marathi/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/marathi-saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Bengali Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bengali/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bengali/saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Punjabi Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Punjabi/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Punjabi/saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "UP Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/pink-lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Bihari Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bihari/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bihari/saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Kannadiga Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Kannadiga/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/telugu-bride.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Kannadiga/saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Jharkhand Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Marwadi Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Odiya Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Odia/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Odia/saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    },
    "Muslim Bride": {
        "lehnga": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Odia/lehenga.png",
        "gown": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png",
        "saree": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png",
        "others": "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"
    }
}

def download_image(url, filename):
    """Download an image from URL and save it with the given filename"""
    try:
        print(f"Downloading: {filename}")
        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
        }

        response = requests.get(url, headers=headers, timeout=30)
        response.raise_for_status()

        filepath = os.path.join(output_dir, filename)
        with open(filepath, 'wb') as f:
            f.write(response.content)

        print(f"✅ Successfully downloaded: {filename}")
        return True

    except Exception as e:
        print(f"❌ Failed to download {filename}: {str(e)}")
        return False

def main():
    """Download all images from the mapping"""
    total_images = 0
    successful_downloads = 0

    # Keep track of downloaded URLs to avoid duplicates
    downloaded_urls = set()

    for bride_type, outfits in image_data.items():
        print(f"\n📂 Processing {bride_type}...")

        for outfit_type, url in outfits.items():
            if url in downloaded_urls:
                print(f"⏭️  Skipping duplicate: {bride_type}-{outfit_type}")
                continue

            # Create filename: telugu-lehnga.png
            state_name = bride_type.lower().replace(' bride', '').replace(' ', '')
            filename = f"{state_name}-{outfit_type}.png"

            total_images += 1
            if download_image(url, filename):
                successful_downloads += 1
                downloaded_urls.add(url)

            # Small delay to be respectful to the server
            time.sleep(0.5)

    print(f"\n🎉 Download Summary:")
    print(f"Total images: {total_images}")
    print(f"Successfully downloaded: {successful_downloads}")
    print(f"Failed: {total_images - successful_downloads}")
    print(f"Unique images: {len(downloaded_urls)}")
    print(f"Images saved in: {output_dir}")

if __name__ == "__main__":
    main()
