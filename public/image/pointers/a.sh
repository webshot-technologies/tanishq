#!/bin/bash
for f in left-*.png; do
  magick "$f" -flop "${f/left-/right-}"
done
