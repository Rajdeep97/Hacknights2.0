```
import pandas as pd
import numpy as np
from keras.models import Sequential
from keras.layers import Dense
from keras.layers import LSTM
from keras.layers import Dropout

data = pd.DataFrame(data=pd.read_csv("test1.csv"))
#print(data)
data.dropna(inplace=True)
#print(data.values)

x_train = data[["Date","Open","High","Low","Adj Close","Volume"]]
data['Date'] = pd.to_datetime(data.Date)
print(x_train)
y_train = data["Close"]
print(y_train)

#converting into an array
x_train, y_train = np.array(x_train), np.array(y_train)

#LSTM needs 3d array 
x_train = np.reshape(x_train,(x_train.shape[0],x_train.shape[1],1))

data1 = pd.DataFrame(data=pd.read_csv("test1.csv"))
#print(data)
data1.dropna(inplace=True)
#print(data.values)
"""
x_test = []
x_test = data1[["Date","Open","High","Low","Adj Close","Volume"]]
data1["Date"] = pd.to_datetime(data1.Date,format='%d-%m-%Y')
print(x_test)
x_test = np.array(x_test)
"""
model = Sequential()
model.add(LSTM(units=100,return_sequences=True,input_shape=(x_train.shape[1],1)))
model.add(LSTM(units=100))
model.add(Dense(1))
model.compile(loss='mean_squared_error',optimizer='adam')
model.fit(x_train, y_train, epochs=1, batch_size=1, verbose=2)
"""
closing_price = model.predict(x_test)
print(closing_price)
"""

#1
from flask import Flask, render_template, request, redirect
from flask import session
import pandas as pd
import json
import numpy as np
import datetime
from keras.models import model_from_json
import tensorflow as tf
from keras import backend as K
app = Flask(__name__)


@app.route('/home')
def web():
	return render_template("web_test.html")

@app.route('/process',methods=['GET','POST'])
def process():
	K.clear_session()
	data = pd.DataFrame(columns=["Open","High","Low","Close","Volume"])
	open1 = []
	high1 = []
	low1 = []
	close1 = []
	volume1 = []
	json_file = open('model_save.json', 'r')
	loaded_model_json = json_file.read()
	json_file.close()
	model = model_from_json(loaded_model_json)
	model.load_weights('model_save.h5')
	open12=request.form['open']
	high12 =request.form['high']
	low12 =request.form['low']
	close12 =request.form['close']
	volume12 =request.form['volume']
	open12=int(open12)
	high12=int(high12)
	low12=int(low12)
	close12=int(close12)
	volume12=int(volume12)
	open1.append(open12)
	high1.append(high12)
	low1.append(low12)
	close1.append(close12)
	volume1.append(volume12)
	data["Open"]=open1
	data["High"]=high1
	data["Low"]=low1
	data["Close"]=close1
	data["Volume"]=volume1
	print(data)
	data = np.array(data)
	data = np.reshape(data,(data.shape[0],5,1))
	closing_price = model.predict(data)
	print(closing_price)
	K.clear_session()
	return render_template("web_test.html",key1=open12,key2=high12,key3=low12,key4=close12,key5=volume12,value=closing_price)

if __name__ == '__main__':
	app.run(debug=True,port=5000)

#2
<html>
	<body>
		<div class="container">
		
			
				User: {{key}}
			
			
			
				
				Bot:  {{value}}
		
			<form action = "/process" method = "POST">
				<div class="form-group">
					<input type="text" name="user_input" class="form-control">
					<button type="submit" class="btn btn-primary">Send
					</button>
			</form>
		</div>
	</body>
</html> 
#3
import pandas as pd
import numpy as np
import json
from keras.models import Sequential
from keras.layers import Dense
from keras.layers import LSTM
from keras.layers import Dropout
from keras.layers import Activation

data = pd.DataFrame(data=pd.read_csv("test1.csv"))
dt =pd.DataFrame(data=pd.read_csv("test1.csv"))
#print(data)
dt.dropna(inplace=True)
data.dropna(inplace=True)
#print(data.values)

x_train = data[["Open","High","Low","Close","Volume"]]
print(x_train)

y_train = data["Close"]
print(y_train)

#converting into an array
x_train, y_train = np.array(x_train), np.array(y_train)

#LSTM needs 3d array 
x_train = np.reshape(x_train,(x_train.shape[0],x_train.shape[1],1))

dt1 =pd.DataFrame(data=pd.read_csv("test.csv"))
x_test = []
x_test = dt1[["Open","High","Low","Close","Volume"]]
x_test = np.array(x_test)
x_test = np.reshape(x_test,(x_test.shape[0],x_test.shape[1],1))

model = Sequential()
model.add(LSTM(units=50,return_sequences=True,input_shape=(x_train.shape[1],1)))
model.add(LSTM(units=50))
model.add(Dense(1))
model.add(Activation('relu'))
model.compile(loss='logcosh',optimizer='adam')
model.fit(x_train, y_train, epochs=50, batch_size=32 ,verbose=1)
closing_price = model.predict(x_test)
print(closing_price)

model_json = model.to_json()
with open('model_save.json', 'w') as json_file:
    json_file.write(model_json)

model.save_weights('model_save.h5')
print('done.....')

