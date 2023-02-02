#plain = [69, 83, 65, 73, 80, 123, 120, 48, 114, 51, 100, 125]

encrypted_message = [60, 42, 56, 48, 41, 2, 1, 73, 11, 74, 29, 4]
secret_key = [107, 101, 121, 32, 79, 82, 32, 110, 111, 116, 32, 116, 111, 32, 107, 101, 121]


def xor_cipher(message, key):
    decrypted = []
    for i in range(len(message)):
        decrypted.append(int(message[i] ^ key))
    return decrypted

for key in secret_key:
    decrypted = xor_cipher(encrypted_message, key)
    char_list = [chr(num) for num in decrypted]

    decrypted_string = "".join([chr(i) for i in decrypted])

    if "ESAIP{" in decrypted_string:
        print(f"Found flag: {decrypted_string}")
        break
#Found flag: ESAIP{x0r3d}
