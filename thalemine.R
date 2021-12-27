library(InterMineR)
im <- initInterMine(mine=listMines()["ThaleMine"])

queryGene <- list()

queryGene$model <- "genomic"
names(queryGene$model) <- "name"

queryGene$title <- "Gene --> Functional Annotations"

queryGene$description <- "retrieves the GeneRif annotation connected to the gene."

queryGene$select <- c("Gene.primaryIdentifier", "Gene.symbol", "Gene.name", "Gene.briefDescription")

#queryGene$constraintLogic <- "A and B"

queryGene$name <- "gene_generif"

queryGene$comment <- ""

queryGene$tags <- c("im:aspect:Function", "im:frontpage", "im:public")

queryGene$rank <- "6"

queryGene$orderBy <- list()
queryGene$orderBy[[1]] <- "Gene.primaryIdentifier ASC"

queryGene$where <- list()
queryGene$where[[1]] <- list()
queryGene$where[[1]]$path <- "Gene"
queryGene$where[[1]]$op <- "LOOKUP"
queryGene$where[[1]]$code <- "A"
queryGene$where[[1]]$editable <- TRUE
queryGene$where[[1]]$switchable <- FALSE
queryGene$where[[1]]$switched <- "LOCKED"
queryGene$where[[1]]$value <- "AT*"


resGene <- runQuery(im, queryGene)
write.table(resGene, file = "data/ENSG.txt", quote = FALSE, sep = "\t", row.names=FALSE, col.names=FALSE)
