#, -*- coding: utf-8 -*-
"""
Spyder Editor

This is a temporary script file.
@author: rangryk
"""
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import matplotlib.animation as animation
from matplotlib import style
from matplotlib.ticker import StrMethodFormatter
from pandas import DataFrame, Series
import seaborn as sns; sns.set()
plt.style.use('seaborn-whitegrid')


df= pd.read_csv('E:\DataPrep\dataPrep.csv', sep=',') #use complete path
dc= df[['Attr 0','Attr 1','Attr 2', 'Attr 3']] # by histogram
dc.to_csv('Others.csv',encoding='utf-8')


ax=df.plot.hist(bins=5,stacked=True)

sns.set(style="whitegrid")
tips = sns.load_dataset("tips")
ax = sns.violinplot(x=tips["total_bill"])

pd.plotting.scatter_matrix(df, alpha=0.5, figsize=(15, 15))
plt.show()

print(df)

















"""
df=df[df.columns[[0,1,2,3,13]]] #by numbers
"""
"""
df=df[df.columns[[0]]] # by numbers
"""










"""
ax=df['Others.csv'].plot.hist(bins=10)
df.hist(column='Data_quality_report')
"""
