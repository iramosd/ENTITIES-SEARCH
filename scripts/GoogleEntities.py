#!/usr/bin/env python

import sys

arguments = sys.argv

if (len(arguments) > 1 and len(arguments[1]) > 0):
    print ("Lista de argumentos: ", arguments[1])
else:
    print("No arguments found")

file = open('plainText.txt')
plainText = file.read()

print(plainText)
