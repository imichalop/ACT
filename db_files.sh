#!/bin/bash
: <<'END'
cut -f1,2 expression.txt | sort -u > sample.txt
php Parsers/Create_Samples.php > samples.txt
php Parsers/Create_Probeset.php expression.txt | sort -u > probeset.txt
php Parsers/Create_Probesets.php > probesets.txt
cut -f2 probeset.txt | sort -u > selected_genes.txt
cut -f2 probeset.txt | sort -u > genes.txt
END
