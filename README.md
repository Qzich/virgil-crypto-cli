# virgil-crypto-cli

This is user guide shows how to use encryption operations such as generation keys, encryption and 
decryption content with *Virgil SDK* by using simple CLI commands.

Before use any crypto operation you need generate keys or have them prepared.

##Generate keys
```
./bin/generate_keys --identity=alice
./bin/generate_keys --identity=bob
./bin/generate_keys --identity=alex
```

 * where `--identity` key specifies identity name.

##Encrypt content
```
echo 'bob and alice are best friedns' |  ./bin/encrypt --for='alice, bob' > encrypted.txt
```
 * where `--for` key specifies list of identities to encrypt `bob and alice are best friedns` string.
 
##Decrypt content
```
cat encrypted.txt | ./bin/decrypt --with='alice'
```
 * where `--with` key specifies identity name to decrypt content from `encrypted.txt`.
 
In case when data is tried to be decrypted with invalid identity you will get exception.

```
//expected exception as alex is not recipient

cat encrypted.txt | ./bin/decrypt --with='alex'
```
