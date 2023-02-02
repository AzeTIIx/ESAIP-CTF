#find the encryption method, hint : be XOR not to be

encrypted_message = [60, 42, 56, 48, 41, 2, 1, 73, 11, 74, 29, 4]
secret_key = [107, 101, 121, 32, 79, 82, 32, 110, 111, 116, 32, 116, 111, 32, 107, 101, 121]


def cipher(message, key):
    decrypted = []
    for i in range(len(message)):
        #Your code goes here
        return 0

for key in secret_key:
    decrypted = cipher(encrypted_message, key)
    char_list = [chr(num) for num in decrypted]

    decrypted_string = "".join([chr(i) for i in decrypted])

    #Your code goes here