import os
import sklearn as sk
import scipy as sp
import pandas as pd
import numpy as np
from sklearn import preprocessing
"""from sklearn.navie_bayes import GaussianNB 
"""
from sklearn.metrics import confusion_matrix
from sklearn.metrics import f1_score
from sklearn import metrics
from sklearn.metrics import accuracy_score
"""from sklearn.metrics import roc_score
"""
from sklearn.model_selection import train_test_split
from sklearn.metrics import roc_auc_score
from sklearn.datasets import make_classification
from sklearn.neighbors import KNeighborsClassifier
from sklearn.model_selection import train_test_split


df= pd.read_csv('wineData.csv', sep=',') 
le = preprocessing.LabelEncoder()

encoded_class = le.fit_transform(df.Class)

Alcohol =df['Alcohol'].values.reshape(-1,1)

Malic =df['Malic acid'].values.reshape(-1,1)

Ash= df['Ash'].values.reshape(-1,1)

Alcalinity = df['Alcalinity of ash'].values.reshape(-1,1)

Magnesium = df['Magnesium'].values.reshape(-1,1)

Total=df['Total phenols'].values.reshape(-1,1)

Flavanoids=df['Flavanoids'].values.reshape(-1,1)

Non = df['Nonflavanoid phenols'].values.reshape(-1,1)

Pro = df['Proanthocyanins'].values.reshape(-1,1)

Color = df['Color intensity'].values.reshape(-1,1)

Hue=df['Hue'].values.reshape(-1,1)

OD= df['OD280/OD315 of diluted wines'].values.reshape(-1,1)

Proline =df['Proline'].values.reshape(-1,1)

class_encoded = le.fit_transform(df.Class)
print('Class Mapped:',class_encoded)
df.head()   
df.tail()



from sklearn.preprocessing import MinMaxScaler
scaler = preprocessing.MinMaxScaler(feature_range =(0,3))
xAlcohol=scaler.fit_transform(Alcohol)
xMalic=scaler.fit_transform(Malic)
xAsh = scaler.fit_transform(Ash)
xAlcalinity = scaler.fit_transform(Alcalinity)
xMagnesium = scaler.fit_transform(Magnesium)
xTotal = scaler.fit_transform(Total)
xFlavanoids = scaler.fit_transform(Flavanoids)
xNon = scaler.fit_transform(Non)
xPro= scaler.fit_transform(Pro)
xColor=scaler.fit_transform(Color)
xHue= scaler.fit_transform(Hue)
xOD = scaler.fit_transform(OD)
xProline = scaler.fit_transform(Proline)
array = zip(xAlcohol,xMalic,xAsh)
print(array)

dict = {'Class': encoded_class, 'Alchohol': xAlcohol, 'Malic': xMalic, 'Alcalinity':xAlcalinity, 'Magnesium': xMagnesium, 'Total': xTotal, ''}  
np.savetxt('wineNormalized.csv',np.column_stack((class_encoded, xAlcohol,xMalic,
  xAsh,xAlcalinity,xMagnesium, xTotal,xFlavanoids,
  xNon, xPro, xColor, xHue, xOD,xProline)) ,delimiter=",",fmt="%s",)
