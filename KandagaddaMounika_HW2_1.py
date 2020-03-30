# -*- coding: utf-8 -*-
"""
Created on Sun Oct  6 22:16:17 2019

@author: Mounika
"""
import pandas as pd

#read the csv file
df= pd.read_csv('E:\DataPrep\dataPrep.csv', sep=',') #use complete path

#selecting subset of columns
qv= df[['Attr 4', 'Attr 5', 'Attr 6', 'Attr 7', 'Attr 8','Attr 9', 'Attr 10', 'Attr 11', 'Attr 12']] # by histogram
others = df[['Attr 0','Attr 1','Attr 2','Attr 3','Labels']]

#saving the subset data to each csv file
qv.to_csv('E:\Data Science Assignments\KandagaddaMounika_HW2\Quantative.csv',encoding='utf-8',index=False)
others.to_csv('E:\Data Science Assignments\KandagaddaMounika_HW2\Others.csv',encoding='utf-8',index=False)
