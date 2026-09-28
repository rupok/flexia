Sora and Inter are distributed under the SIL Open Font License 1.1.
See Sora-OFL.txt and Inter-OFL.txt.

Original TTF files are retained from the Flexia 3.1.0 distribution.
WOFF2 files are losslessly compressed from those TTF files using fontTools 4.60.0.
The full WOFF2 files are kept for sites that reference them directly.
theme.json declares per-script subsets instead: *_latin.woff2 (Google Fonts'
"latin" range) and *_ext.woff2 (every other glyph in the font), each with its
unicodeRange, so Latin-only pages download only the latin file.
Subsets were cut from the TTF files with fontTools 4.60.0 pyftsubset
(layout features, name table and hinting kept).

License sources retrieved 2026-09-10:
https://raw.githubusercontent.com/google/fonts/main/ofl/sora/OFL.txt
https://raw.githubusercontent.com/google/fonts/main/ofl/inter/OFL.txt
