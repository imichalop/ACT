#!/bin/bash
cut -f1,2 data/expression.txt | sort -u > data/sample.txt
php Parsers/Create_Samples.php > data/samples.txt
php Parsers/Create_Probeset.php data/expression.txt | sort -u > data/probeset.txt
php Parsers/Create_Probesets.php > data/probesets.txt
cut -f2 data/probeset.txt | sort -u > data/selected_genes.txt
Rscript thalemine.R
