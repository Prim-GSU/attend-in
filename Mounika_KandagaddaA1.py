#%%
from random import randint
import os
import binascii
import sys
#%%
#checking for version of python
if(sys.version_info[0] < 3.0):
    print('Need Python version > 3.5 to run this code')
    sys.exit()
# %%
#
def byte_xor(ba1, ba2):
    return bytes([_a ^ _b for _a, _b in zip(ba1, ba2)])

#%%
#generating 24 bit random key
key = os.urandom(3)
print('Key generated of 3 bytes ',key)

#generate 6 random integers between 48 and 122 and convert them to bytes 
byte_message = [randint(48,122).to_bytes(1,'little') for i in range(6)]

#join the above 6 individual bytes to make it a single message of 6 bytes
message = b''.join(byte_message)
print('6 bytes of message ',message)

#concatenate key to make length equal to byte_message_join
key_padded = b''.join([key for i in range(1,len(message)//2)])
print('Concatenated key ',key_padded)



# %%
encrypted_message = byte_xor(message,key_padded)
print('Encrypted Message ', encrypted_message)

decrypted_message = byte_xor(encrypted_message,key_padded)
print('Decrypted Message ',decrypted_message)

if(str(message) == str(decrypted_message)):
    print('Encrypted message is successfully decrpted :P')

# %%
