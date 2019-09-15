import pandas as pd
from textblob import TextBlob
import sys, tweepy
import datetime

consumerKey = "1U8kB4x6QU4T9SvKKlgm2n1Mk"
consumerSecret = "aBdS2ArtjQNRehDC2egMXW1GIDYt8TbmoA3ZDnIGopcId9Ps6l"
accessToken = "125011953-QKeqKgi7rKvJgEpbFbtkCPoqVtafox6noGfKzsST"
accessTokenSecret = "903nCZfq7O8bUBVea6Fe3gwYaC9UZJe2x0XRLZpMeZ3qg"

auth = tweepy.OAuthHandler(consumerKey, consumerSecret)
auth.set_access_token(accessToken, accessTokenSecret)
api = tweepy.API(auth,wait_on_rate_limit = True)

MAX_TWEETS = 50000

df = pd.DataFrame(columns=['Date','Text'])
msgs = []
time = []
strr="-"
for tweet in tweepy.Cursor(api.search, q='#microsoft', rpp=100).items(MAX_TWEETS):

    msgs.append(tweet.text)
    time.append(tweet.created_at)

    #msg = list(msg)                    
    #df.Text.append(msg,ignore_index=False)
    
    
print(msgs)
print(time)
df['Date']=time
df['Text']=msgs
df.to_csv("Tweets.csv")