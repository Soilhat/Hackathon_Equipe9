# -*-coding:utf8 -*

import sys
import pickle
import pandas as pd
import numpy as np

model = pickle.load(open("../ml_scripts/model.pickle",'rb'))

data = sys.argv[1]
data = data.replace('[', "")
data = data.replace(']','')

data = data.split(',')

matieres = {
    "HG" : "Histoire-géographie",
    "LV" : "LV1, LV2"
}
data = [matieres[x] if x in matieres.keys() else x for x in data]
# Chargement du jeu de données
dataset = pd.read_excel('../ml_scripts/datatest.xlsx')

# Séparation des features et de la target
X,y = dataset[dataset.columns[:9]] , dataset["Domaines"]

# Modification des variables textuelles en chiffre
new=[]
for index in range(len(data)):
    tab = X.iloc[:, index].unique()
    new.append(np.where(tab == data[index])[0][0])

print(model.predict([new])[0])