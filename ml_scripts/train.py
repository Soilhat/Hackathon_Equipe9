import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn import neighbors
from sklearn.metrics import accuracy_score
import pickle

# Chargement du jeu de données
dataset = pd.read_excel('ml_scripts/datatest.xlsx')

# Séparation des features et de la target
X,y = dataset[dataset.columns[:9]] , dataset["Domaines"]

# Modification des variables textuelles en chiffre
for column in X.columns:
    X[column] = X[column].replace(X[column].unique(), range(len(X[column].unique())))

# Séparation en jeu de test et d'entraînement
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=0)

# Entraînement du modèle KNN
n_neighbors = 15
clf = neighbors.KNeighborsClassifier(n_neighbors)
knn = clf.fit(X, y)

#Prediction du jeu de test et affichage de la précision
knn_pred = knn.predict(X_test)
print("Accuracy : {}".format(accuracy_score(y_test, knn_pred)))

pickle.dump(knn, open("ml_scripts/model.pickle","wb")) # 96% de précision