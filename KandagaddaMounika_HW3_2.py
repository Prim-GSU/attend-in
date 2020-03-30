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


df= pd.read_csv('wineNormalized.csv', sep=',')

Class= df['Class']

Alcohol = df['Alcohol']

Ash= df['Ash']

Alcalinity = df['Alcalinity of ash']

Magnesium = df['Magnesium']

Total=df['Total phenols']

Flavanoids=df['Flavanoids']

Non = df['Nonflavanoid phenols']

Pro = df['Proanthocyanins']

Color = df['Color intensity']

Hue=df['Hue']

OD= df['OD280/OD315 of diluted wines']

Proline =df['Proline']

array = zip(Alcohol,Malic, Ash,Magnesium,Total,Flavanoids,Non,Pro,Color,Hue,OD,Proline)

features = np.array([*list(array)])

print ('Features:\n', features)
 
from sklearn.model_selection import StratifiedShuffleSplit

X = np.array([[1, 2], [3, 4], [1, 2], [3, 4], [1, 2], [3, 4]])

y = np.array([0, 0, 0, 1, 1, 1])
sss.StratifiedShuffleSplit(n_splits=10, test_size=0.66, random_state=0)
sss.get_n_splits(features,Class)
print(sss)
sss.StratifiedShuffleSplit(n_splits=10, test_size=0.66, random_state=0)

for train_index, test_index in sss.split(features, Class):
 print("TRAIN:", train_index, "TEST:", test_index)
    
X_train, X_test = features[train_index], features[test_index]
y_train, y_test = Class[train_index], Class[test_index]
    
    
np.savetxt('E:\wineData\wineNormalized.csv',np.column_stack((y_train,X_train)),delimiter=",",fmt='%s')
np.savetxt('E:\wineData\wineNormalized.csv',np.column_stack((y_test, X_test)),delimiter=",",fmt='%s')

from sklearn.tree import DecisionTreeClassifier
clf2 = DecisionTreeClassifier()
clf2.fit(X_train,y_train)
y_pred = clf2.predict(X_test)


print("Accuracy:",metrics.accuracy_score(y_test, y_pred))


print(df)