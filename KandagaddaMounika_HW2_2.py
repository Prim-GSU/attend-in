#, -*- coding: utf-8 -*-

import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import matplotlib.animation as animation
from matplotlib import style
from matplotlib.ticker import StrMethodFormatter
from pandas import DataFrame, Series
import seaborn as sns; sns.set()
plt.style.use('seaborn-whitegrid')
from datatest import validate

#reading from the current folder
df= pd.read_csv('Quantative.csv', sep=',') #use complete path

#Attr4 = df
x = df['Attr 5']
#sns.distplot(x, bins=20, kde=False, rug=True);

##generating hiostograms for each attribute
#for i in df.columns:
#    attr = df[i]
#    sns.distplot(attr)

#for column in df:
#    print(column)
#    columnSeriesObj = df[column]
#    print(columnSeriesObj)
x.plot.hist(bins=4) #plotting histograms
print("test")
Attr5 = df['Attr 5']
Attr5.plot.hist(bins=5)
    
    # plotting horizontal violin plots
sns.set(style="whitegrid")
tips = sns.load_dataset("Frequency")
ax = sns.violinplot(x=tips["Attributes"])

#plotting scatter materix
pd.plotting.scatter_matrix(df, alpha=0.5, figsize=(15, 15))
plt.show()

#covariance tables
np.random.seed(42)
df=pd.DataFrame(np.random.randn(1000,9),columns=['Attr 4','Attr 5', 'Attr 6','Attr 7', 'Attr 8', 'Attr 9', 'Attr 10', 'Attr 11','Attr 12'])
df.cov()

#correlation tables and heat maps of covariance and corr
df_corr = df.corr()
print(df_corr.head())
data1 = df_corr.values
fig1 = plt.figure()
ax1 = fig1.add_subplot(111)
heatmap1 = ax1.pcolor(data1, cmap=plt.cm.RdYlGn)


data = pd.read_csv('Quantitative.csv',sep=',')
corr = data.corr()
ax = sns.heatmap(
    corr, 
    vmin=-1, vmax=1, center=0,
    cmap=sns.diverging_palette(20, 220, n=200),
    square=True
)
ax.set_xticklabels(
    ax.get_xticklabels(),
    rotation=45,
    horizontalalignment=('right')
)

df = pd.DataFrame(np.random.randn(1000,9))

from scipy import stats
df[(np.abs(stats.zscore(df)) <3).all(axis=1)]






#def test_outliers1():
#    data = ['Attr 5', 'Attr 6']  # <- 87 is an outlier
#
#    requirement = RequiredOutliers(data, multiplier=2.2)
#
#    validate(data, requirement)



#def outliers_iqr(ys):
#    quartile_1, quartile_3 = np.percentile(ys, [25, 75])
#    iqr = quartile_3 - quartile_1
#    lower_bound = quartile_1 - (iqr * 1.5)
#    upper_bound = quartile_3 + (iqr * 1.5)
#    return np.where((ys > upper_bound) | (ys < lower_bound))

#
#"""
#df=df[df.columns[[0,1,2,3,13]]] #by numbers
#"""
#"""
#df=df[df.columns[[0]]] # by numbers
#"""

#"""
#ax=df['Others.csv'].plot.hist(bins=10)
#df.hist(column='Data_quality_report')
#"""
