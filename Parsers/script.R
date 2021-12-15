#!/usr/bin/env Rscript
args = commandArgs(trailingOnly=TRUE)
library(affyPLM)
library(simpleaffy)
setwd(args[1])  
#read all CEL files from current working directory
readdata <- ReadAffy(compress = FALSE)
qcs <- qc(readdata)
x <- percent.present(qcs)
#Y <- as.data.frame(t(x))
write.table(x,file = "PP.txt",sep= "\t")
dataPLM <- fitPLM(readdata,output.param=list(varcov="none"))
xx <- RLE(dataPLM, type = "values")
func <- function(x){quantile(x)}
yy <- apply(xx,2,func)
YY <- as.data.frame(t(yy))
write.table(YY,file = "RLE.txt",sep= "\t")
xxx <- NUSE(dataPLM, type = "values")
yyy <- apply(xxx,2,func)
YYY <- as.data.frame(t(yyy))
write.table(YYY,file = "NUSE.txt",sep= "\t")

