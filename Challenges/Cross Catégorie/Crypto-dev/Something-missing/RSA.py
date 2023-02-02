import rsa, base64, sys

def string_encode(string):
    string = string.encode(encoding='UTF-8',errors='strict')
    return base64.b64encode(string)

def string_decode(string):
    string = base64.b64decode(string)
    return string.decode(encoding='UTF-8',errors='strict')

def isBase64(s):
    try:
        return base64.b64encode(base64.b64decode(s)) == s
    except Exception:
        return False

def key_pair_generation():
    (pubkey, prikey) = rsa.newkeys(1024, poolsize = 8)
    return (pubkey, prikey)

def encrypt(plain, pubkey):
    cypher = rsa.encrypt(plain, pubkey)
    return cypher

def decrypt(cypher, prikey):
    message = rsa.decrypt(cypher, prikey)

def handleBase64String(InputString, prikey):
    decText = decrypt(InputString, prikey)
    return string_decode(decText)

def handleString(InputString, pubkey):
    encText = string_encode(InputString)
    return encrypt(encText, pubkey)


def main():
    if len(sys.argv) < 2:
        print("Usage: python3 RSA.pys MESSAGE\n\nUsing a very secret encryption key, the program will intelligently encrypt/decrypt your message!\n")
        return
    InputString = " ".join(sys.argv[1:])
    InputString = InputString.replace('\n', "")

    if isBase64(InputString) == True:
        print("Message already encrypted")
    else :
        encrypted = handleString(InputString, pubkey)
        print("Encrypted text is : {}" .format(encrypted))
        decrypted = handleBase64String(encrypted, prikey)
        print("Decrypted text is : {}" .format(decrypted))

if __name__ == "__main__":
    main()


