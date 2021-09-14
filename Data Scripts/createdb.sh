#!/bin/bash
: <<'END'
php biomart.php ENSG.xml 4 | sort -u > ENSG.txt
#php Selected_Genes.php > Selected_Genes.txt
php GO.php > GO.txt
php biomart.php ENSG_GO.xml 2 | sort -u > ENSG_GO.txt
php PO.php > PO.txt
php biomart.php ENSG_PO.xml 2 | sort -u > ENSG_PO.txt
wget -q ftp://ftp.ebi.ac.uk/pub/databases/Pfam/current_release/database_files/pfamA.txt.gz && gunzip -f pfamA.txt.gz && php pfamA.php > Pfam.txt
php biomart.php ENSG_Pfam.xml 2 | sort -u > ENSG_Pfam.txt
php KEGG.php > KEGG.txt
php keggbiomart.php ENSG_KEGG.xml 2 | sort -u > ENSG_KEGG.txt
php AraCyc.php
sort -u ENSG_AraCyc.txt > ENSG_AraCyc1.txt && mv ENSG_AraCyc1.txt ENSG_AraCyc.txt
php Entrez_Wikipathways.php
wget -q -O Entrez_ENSG.txt https://www.arabidopsis.org/download_files/Genes/TAIR10_genome_release/TAIR10_NCBI_mapping_files/TAIR10_NCBI_GENEID_mapping
cut -f1 Entrez_ENSG.txt Entrez_WP.txt | sort -nu > Entrez.txt
wget -q https://agris-knowledgebase.org/Downloads/AtRegNet.zip && unzip -qo AtRegNet.zip && rm AtRegNet.zip && php AtRegNet.php| sort -u > AtRegNet.txt
cut -f2 AtRegNet.txt | sort -u > TF.txt
wget -q http://neomorph.salk.edu/dap_web/pages/dap_data_v4/fullset/dap_download_may2016_genes.zip && unzip -qo dap_download_may2016_genes.zip && rm dap_download_may2016_genes.zip
mv dap_data_v4/genes/ . && php Ecker.php > Ecker.txt
cut -f1 Ecker.txt | sort -u > TF1.txt && cut -f2 Ecker.txt | sort -u >> TF1.txt && sort -u TF1.txt > Ecker_TF.txt
END
