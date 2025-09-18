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
    if curl -L -o "$output_path" "$url" --connect-timeout 30 --max-time 60 --silent --show-error --user-agent "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36"; then
        echo "✅ Successfully downloaded: $filename"
        return 0
    else
        echo "❌ Failed to download: $filename"
        return 1
    fi
}

echo "🚀 Starting image downloads..."
echo "📂 Output directory: public/image/bystate"
echo ""

total_images=0
successful_downloads=0

# Telugu Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-lehenga.png" "telugu-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/telugu-bride.png" "telugu-gown.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/punb-saree.png" "telugu-saree.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brideCategory/others.png" "telugu-others.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Gujarati Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Gujarati/lehenga.png" "gujarati-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/guj-gown.png" "gujarati-gown.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate saree (punb-saree.png already downloaded)
echo "⏭️  Skipping duplicate: gujarati-saree (same as telugu-saree)"

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: gujarati-others (same as telugu-others)"

# Tamil Bride
# Skip duplicate lehnga (punb-lehenga.png already downloaded)
echo "⏭️  Skipping duplicate: tamil-lehnga (same as telugu-lehnga)"

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/kannadiga-gown.png" "tamil-gown.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate saree (punb-saree.png already downloaded)
echo "⏭️  Skipping duplicate: tamil-saree (same as telugu-saree)"

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: tamil-others (same as telugu-others)"

# Marathi Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Marathi/lehenga.png" "marathi-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate gown (guj-gown.png already downloaded)
echo "⏭️  Skipping duplicate: marathi-gown (same as gujarati-gown)"

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/marathi-saree.png" "marathi-saree.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: marathi-others (same as telugu-others)"

# Bengali Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bengali/lehenga.png" "bengali-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate gown (guj-gown.png already downloaded)
echo "⏭️  Skipping duplicate: bengali-gown (same as gujarati-gown)"

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bengali/saree.png" "bengali-saree.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: bengali-others (same as telugu-others)"

# Punjabi Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Punjabi/lehenga.png" "punjabi-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate gown (guj-gown.png already downloaded)
echo "⏭️  Skipping duplicate: punjabi-gown (same as gujarati-gown)"

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Punjabi/saree.png" "punjabi-saree.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: punjabi-others (same as telugu-others)"

# UP Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/pink-lehenga.png" "up-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate gown (guj-gown.png already downloaded)
echo "⏭️  Skipping duplicate: up-gown (same as gujarati-gown)"

# Skip duplicate saree (punb-saree.png already downloaded)
echo "⏭️  Skipping duplicate: up-saree (same as telugu-saree)"

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: up-others (same as telugu-others)"

# Bihari Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bihari/lehenga.png" "bihari-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate gown (guj-gown.png already downloaded)
echo "⏭️  Skipping duplicate: bihari-gown (same as gujarati-gown)"

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Bihari/saree.png" "bihari-saree.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: bihari-others (same as telugu-others)"

# Kannadiga Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Kannadiga/lehenga.png" "kannadiga-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate gown (telugu-bride.png already downloaded)
echo "⏭️  Skipping duplicate: kannadiga-gown (same as telugu-gown)"

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Kannadiga/saree.png" "kannadiga-saree.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: kannadiga-others (same as telugu-others)"

# Jharkhand Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/lehenga.png" "jharkhand-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/gown.png" "jharkhand-gown.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/jharkhand/saree.png" "jharkhand-saree.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: jharkhand-others (same as telugu-others)"

# Marwadi Bride (uses same images as Jharkhand)
echo "⏭️  Skipping duplicate: marwadi-lehnga (same as jharkhand-lehnga)"
echo "⏭️  Skipping duplicate: marwadi-gown (same as jharkhand-gown)"
echo "⏭️  Skipping duplicate: marwadi-saree (same as jharkhand-saree)"
echo "⏭️  Skipping duplicate: marwadi-others (same as telugu-others)"

# Odiya Bride
download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Odia/lehenga.png" "odiya-lehnga.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate gown (guj-gown.png already downloaded)
echo "⏭️  Skipping duplicate: odiya-gown (same as gujarati-gown)"

download_image "https://staticimg.tanishq.co.in/microsite/rivaah-dreamlist/assets-one/images/brides/Odia/saree.png" "odiya-saree.png"
total_images=$((total_images + 1))
if [ $? -eq 0 ]; then successful_downloads=$((successful_downloads + 1)); fi
sleep 0.5

# Skip duplicate others (others.png already downloaded)
echo "⏭️  Skipping duplicate: odiya-others (same as telugu-others)"

# Muslim Bride (uses same images as Odiya for lehnga, guj for gown, punb for saree)
echo "⏭️  Skipping duplicate: muslim-lehnga (same as odiya-lehnga)"
echo "⏭️  Skipping duplicate: muslim-gown (same as gujarati-gown)"
echo "⏭️  Skipping duplicate: muslim-saree (same as telugu-saree)"
echo "⏭️  Skipping duplicate: muslim-others (same as telugu-others)"

echo ""
echo "🎉 Download Summary:"
echo "Total unique images downloaded: $successful_downloads"
echo "Images saved in: public/image/bystate"
