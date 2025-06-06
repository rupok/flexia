#!/bin/bash
rm -rf build
mkdir build
cp -r . build/flexia
cd build/flexia
rm -rf .git .github .distignore build.sh flexia-todo.md PR-TEMPLATE.md README.md package.json .gitignore .DS_Store
cd ..
zip -r flexia.zip flexia -q
echo "✅ Created build/flexia.zip"
ls -lh flexia.zip
