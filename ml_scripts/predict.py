import sys
import pickle

model = pickle.load(open("model.pickle",'rb'))

data = sys.argv[1]

print(model.predict(data))