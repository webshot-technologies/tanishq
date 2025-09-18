#!/bin/bash

# Create output directory
mkdir -p public/image/bystate

# Function to download an image
download_image() {
    local url=$1
    local filename=$2
    local output_path="public/image/bystate/$filename"

    echo "Downloading: $filename"

    # Use curl to download the image
    if curl -L -o "$output_path" "$url" --connect-timeout 30 --max-time 60 --user-agent "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36"; then
        echo "✅ Successfully downloaded: $filename"
        return 0
    else
        echo "❌ Failed to download: $filename"
        return 1
    fi
}

# Image URLs from the Google doc
declare -A image_urls

# Telugu Bride
image_urls["telugu-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-lehenga.png"
image_urls["telugu-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/telugu-bride.png"
image_urls["telugu-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png"
image_urls["telugu-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Gujarati Bride
image_urls["gujarati-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Gujarati/lehenga.png"
image_urls["gujarati-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png"
image_urls["gujarati-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png"
image_urls["gujarati-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Tamil Bride
image_urls["tamil-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-lehenga.png"
image_urls["tamil-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/kannadiga-gown.png"
image_urls["tamil-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png"
image_urls["tamil-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Marathi Bride
image_urls["marathi-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Marathi/lehenga.png"
image_urls["marathi-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png"
image_urls["marathi-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/marathi-saree.png"
image_urls["marathi-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Bengali Bride
image_urls["bengali-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bengali/lehenga.png"
image_urls["bengali-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png"
image_urls["bengali-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bengali/saree.png"
image_urls["bengali-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Punjabi Bride
image_urls["punjabi-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Punjabi/lehenga.png"
image_urls["punjabi-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png"
image_urls["punjabi-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Punjabi/saree.png"
image_urls["punjabi-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# UP Bride
image_urls["up-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/pink-lehenga.png"
image_urls["up-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png"
image_urls["up-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png"
image_urls["up-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Bihari Bride
image_urls["bihari-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bihari/lehenga.png"
image_urls["bihari-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png"
image_urls["bihari-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bihari/saree.png"
image_urls["bihari-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Kannadiga Bride
image_urls["kannadiga-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Kannadiga/lehenga.png"
image_urls["kannadiga-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/telugu-bride.png"
image_urls["kannadiga-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Kannadiga/saree.png"
image_urls["kannadiga-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Jharkhand Bride
image_urls["jharkhand-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/lehenga.png"
image_urls["jharkhand-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/gown.png"
image_urls["jharkhand-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/saree.png"
image_urls["jharkhand-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Marwadi Bride
image_urls["marwadi-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/lehenga.png"
image_urls["marwadi-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/gown.png"
image_urls["marwadi-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/saree.png"
image_urls["marwadi-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Odiya Bride
image_urls["odiya-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Odia/lehenga.png"
image_urls["odiya-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png"
image_urls["odiya-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Odia/saree.png"
image_urls["odiya-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Muslim Bride
image_urls["muslim-lehnga"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Odia/lehenga.png"
image_urls["muslim-gown"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png"
image_urls["muslim-saree"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png"
image_urls["muslim-others"]="https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png"

# Download all images
echo "🚀 Starting image downloads..."
echo "📂 Output directory: public/image/bystate"
echo ""

total_images=0
successful_downloads=0
declare -A downloaded_urls

for filename in "${!image_urls[@]}"; do
    url="${image_urls[$filename]}"

    # Skip if we've already downloaded this URL
    if [[ -n "${downloaded_urls[$url]}" ]]; then
        echo "⏭️  Skipping duplicate: $filename (same as ${downloaded_urls[$url]})"
        continue
    fi

    total_images=$((total_images + 1))

    if download_image "$url" "$filename.png"; then
        successful_downloads=$((successful_downloads + 1))
        downloaded_urls[$url]=$filename
    fi

    # Small delay to be respectful to the server
    sleep 0.5
done

echo ""
echo "🎉 Download Summary:"
echo "Total images: $total_images"
echo "Successfully downloaded: $successful_downloads"
echo "Failed: $((total_images - successful_downloads))"
echo "Unique URLs: ${#downloaded_urls[@]}"
echo "Images saved in: public/image/bystate"
