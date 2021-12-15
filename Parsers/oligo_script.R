#!/usr/bin/env Rscript
args = commandArgs(trailingOnly=TRUE)
library(oligo)
setwd(args[1])  
#read all CEL files from current working directory
#readdata <- ReadAffy(compress = FALSE)
celFiles <- list.celfiles(full.names=TRUE)
rawData <- read.celfiles(celFiles)
fit1 <- fitProbeLevelModel(rawData)
x <- RLE(fit1, type='stats')
func <- function(x){quantile(x)}
y <- apply(x,2,func)
Y <- as.data.frame(t(y))
write.table(Y,file = "RLE.txt",sep= "\t")
xx <- NUSE(fit1, type='stats')
yy <- apply(xx,2,func)
YY <- as.data.frame(t(yy))
write.table(YY,file = "NUSE.txt",sep= "\t") 
