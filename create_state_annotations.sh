#!/bin/bash

# Create annotation files for all state-specific images
# This script creates annotation files based on the pattern: {state}-{outfit}-annotations.json

echo "🚀 Creating state-specific annotation files..."

# Function to create annotation file
create_annotation_file() {
    local state=$1
    local outfit=$2
    local filename="${state}-${outfit}-annotations.json"
    local filepath="public/data/$filename"

    # Skip if file already exists
    if [ -f "$filepath" ]; then
        echo "⏭️  Skipping existing file: $filename"
        return
    fi

    echo "📝 Creating: $filename"

    # Create annotation file with placeholder data
    cat > "$filepath" << EOF
[
  {
    "id": $(( RANDOM + 30000 )),
    "annotations": [
      {
        "id": $(( RANDOM + 15000 )),
        "completed_by": 177,
        "result": [
          {
            "id": "placeholder-hair",
            "type": "keypointlabels",
            "value": {
              "x": 56.0,
              "y": 6.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["hair-jewellery"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-forehead",
            "type": "keypointlabels",
            "value": {
              "x": 52.0,
              "y": 7.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["forehead-pendant"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-earrings-stud",
            "type": "keypointlabels",
            "value": {
              "x": 47.5,
              "y": 12.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["earrings-stud"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-earrings-drops",
            "type": "keypointlabels",
            "value": {
              "x": 48.0,
              "y": 14.5,
              "width": 0.5813953488372093,
              "keypointlabels": ["earrings-drops"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-ear-loops",
            "type": "keypointlabels",
            "value": {
              "x": 57.5,
              "y": 12.5,
              "width": 0.5813953488372093,
              "keypointlabels": ["ear-loops"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-nose-pin",
            "type": "keypointlabels",
            "value": {
              "x": 53.0,
              "y": 11.5,
              "width": 0.5813953488372093,
              "keypointlabels": ["nose-pin"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-choker",
            "type": "keypointlabels",
            "value": {
              "x": 52.5,
              "y": 16.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["choker-necklace"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-short-necklace",
            "type": "keypointlabels",
            "value": {
              "x": 52.5,
              "y": 18.5,
              "width": 0.5813953488372093,
              "keypointlabels": ["short-necklace"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-long-necklace",
            "type": "keypointlabels",
            "value": {
              "x": 52.5,
              "y": 20.5,
              "width": 0.5813953488372093,
              "keypointlabels": ["long-necklace"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-multiple-bangles",
            "type": "keypointlabels",
            "value": {
              "x": 60.0,
              "y": 36.5,
              "width": 0.5813953488372093,
              "keypointlabels": ["multiple-bangles"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-bracelet",
            "type": "keypointlabels",
            "value": {
              "x": 58.0,
              "y": 37.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["bracelet"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-single-bangle",
            "type": "keypointlabels",
            "value": {
              "x": 44.0,
              "y": 37.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["single-bangle"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-rings",
            "type": "keypointlabels",
            "value": {
              "x": 53.0,
              "y": 41.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["rings"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-waist-belt",
            "type": "keypointlabels",
            "value": {
              "x": 52.0,
              "y": 32.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["waist-belt"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-anklet",
            "type": "keypointlabels",
            "value": {
              "x": 57.0,
              "y": 77.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["anklet"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          },
          {
            "id": "placeholder-toe-ring",
            "type": "keypointlabels",
            "value": {
              "x": 55.0,
              "y": 86.0,
              "width": 0.5813953488372093,
              "keypointlabels": ["toe-ring"]
            },
            "origin": "manual",
            "to_name": "image",
            "from_name": "kp-annotation",
            "image_rotation": 0,
            "original_width": 990,
            "original_height": 1485
          }
        ],
        "was_cancelled": false,
        "ground_truth": false,
        "created_at": "2025-09-18T06:47:45.548932Z",
        "updated_at": "2025-09-18T06:58:49.370029Z",
        "draft_created_at": "2025-09-18T06:46:54.755456Z",
        "lead_time": 345.461,
        "prediction": {},
        "result_count": 16,
        "unique_id": "${state}-${outfit}-$(uuidgen | cut -d'-' -f1)",
        "import_id": null,
        "last_action": null,
        "bulk_created": false,
        "task": $(( RANDOM + 30000 )),
        "project": 27512,
        "updated_by": 177,
        "parent_prediction": null,
        "parent_annotation": null,
        "last_created_by": null
      }
    ],
    "file_upload": "placeholder-${state}-${outfit}.png",
    "drafts": [],
    "predictions": [],
    "data": {
      "image": "upload/27512/placeholder-${state}-${outfit}.png"
    },
    "meta": {},
    "created_at": "2025-09-18T06:08:04.038307Z",
    "updated_at": "2025-09-18T06:58:49.515004Z",
    "inner_id": $(( RANDOM % 10 + 1 )),
    "total_annotations": 1,
    "cancelled_annotations": 0,
    "total_predictions": 0,
    "comment_count": 0,
    "unresolved_comment_count": 0,
    "last_comment_updated_at": null,
    "project": 27512,
    "updated_by": 177,
    "comment_authors": []
  }
]
EOF

    echo "✅ Created: $filename"
}

# Create annotation files for all downloaded images
# Based on the bystate directory contents

echo "📂 Creating annotation files for downloaded images..."

# Telugu
create_annotation_file "telugu" "lehnga"
create_annotation_file "telugu" "gown"
# telugu-saree already exists

# Gujarati
create_annotation_file "gujarati" "lehnga"
create_annotation_file "gujarati" "gown"

# Tamil
create_annotation_file "tamil" "gown"

# Marathi
create_annotation_file "marathi" "lehnga"
create_annotation_file "marathi" "saree"

# Bengali
create_annotation_file "bengali" "lehnga"
create_annotation_file "bengali" "saree"

# Punjabi
create_annotation_file "punjabi" "lehnga"
create_annotation_file "punjabi" "saree"

# UP
create_annotation_file "up" "lehnga"

# Bihari
create_annotation_file "bihari" "lehnga"
create_annotation_file "bihari" "saree"

# Kannadiga
create_annotation_file "kannadiga" "lehnga"
create_annotation_file "kannadiga" "saree"

# Jharkhand
create_annotation_file "jharkhand" "lehnga"
create_annotation_file "jharkhand" "saree"
create_annotation_file "jharkhand" "gown"

# Odiya
create_annotation_file "odiya" "lehnga"
create_annotation_file "odiya" "saree"

echo ""
echo "🎉 Annotation file creation completed!"
echo "📁 Files created in: public/data/"
echo ""
echo "⚠️  NOTE: These are placeholder annotation files with default positioning."
echo "   Replace them with actual annotation data for accurate positioning."
