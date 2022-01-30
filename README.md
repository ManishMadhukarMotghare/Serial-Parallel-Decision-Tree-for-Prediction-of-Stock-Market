# Serial-Parallel-Decision-Tree-for-Prediction-of-Stock-Market
We propose a new algorithm for building decision tree classifiers. The algorithm is executed in
a distributed environment and is especially designed for classifying large data sets and streaming
data. It is empirically shown to be as accurate as a standard decision tree classifier, while being
scalable for processing of streaming data on multiple processors. These findings are supported by
a rigorous analysis of the algorithm’s accuracy.

The essence of the algorithm is to quickly construct histograms at the processors, which com-
press the data to a fixed amount of memory. A master processor uses this information to find
near-optimal split points to terminal tree nodes. Our analysis shows that guarantees on the local
accuracy of split points imply guarantees on the overall tree accuracy.

Keywords: decision tree classifiers, distributed computing, streaming data, scalability
