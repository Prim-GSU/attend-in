#%%
import hashlib

#The below function takes password and salt as Inputs
#Concatenates them and returns the MD5
def ComputeMd5(password,salt):
    ps = str(password)+ str(salt)
    m = hashlib.md5()
    m.update(ps.encode('utf-8'))
    return m.hexdigest()

# %% [markdown]
# The code below prints true or false based on the verification of the hash
# %%
print('Verifying hash: ',ComputeMd5('0599','054') == '4a1d6f102cd95fac33853e4d72fe1dc5')

#%% [markdown]
# # *Problem 2*
# Approach: To print the Password and Salt for a hashvalue, I generated the
#  all possible hash values for for passwords, range [0000,1000],concatenated 
# with salt, range from [000-100], in a dictionary using the tuple (password,salt)
# as key and their hash value as value. Then, I read the hashvalues from the file
# and stored them in a list. For matching the provided hash values with the generated 
# hash values, I loop through the list and match with the dictionary values. If there 
# is a match then I print the corresponding hash, password, and salt   
#  * For using in Problem 3, I'm saving the matched user id, Password, and hash in a dictionary   
# %%
#dictionary to store the { (password,salt) : 'hash' }
pass_salt_hash = {}

#dictionary to store the  { (userid,password) : hash }
user_password_hash = {}

for i in range(0,1001):
    password = str(i).zfill(4)
    #print(password)
    for j in range(0,101):
        #use zfill method to add starting zeroes
        salt = str(j).zfill(3)
        pass_salt_hash[(password,salt)] = ComputeMd5(password,salt)

# %%
#reading the Hash from the file and generating a list
f = open("Hash.txt", "r")
hash_list = [x.rstrip('\n') for x in f]

# %%
print("[UID","       Hashed Password              ","Password      ","Salt]",sep="     ")
for i in range(0,len(hash_list)):
    for x in pass_salt_hash:
        if hash_list[i] == pass_salt_hash[x]:
            uid = str(i+1).zfill(3)
            hashed_password = hash_list[i]
            password = x[0]
            salt = x[1]
            print(uid,hashed_password,password,salt,sep="           ")
            user_password_hash[(uid,password)] = hashed_password

# %% [markdown]
# # *Problem 3*
# 1. Read the Input from console for Password and Salt
# 2. Check if my dictionary, user_password_hash, contains the key for entered 
# (userid,password). If exists then the username and password are matched 

# %%
userid = input('Please enter the User ID: ')
password = input('Please Enter the Password: ')
if (userid,password) in user_password_hash:
    print(userid,password, sep='    ')
    print('The input userid and password matches the hashvalue in database')
else:
    print('The input userid and password does not match the hashvalue in database')

# %%
