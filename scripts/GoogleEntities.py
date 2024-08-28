#!/usr/bin/env python

from google.cloud import language_v2
import json
import os
import sys

current_directory = os.path.dirname(os.path.abspath(__file__))

auth_path = current_directory+'/nlp-auth.json'
os.environ["GOOGLE_APPLICATION_CREDENTIALS"] = auth_path

arguments = sys.argv

file = open(current_directory+'/plainText.txt')
plain_text = file.read()

def sample_analyze_entities(text_content: str = "") -> list:

    json_response = []
    client = language_v2.LanguageServiceClient()

    document_type_in_plain_text = language_v2.Document.Type.PLAIN_TEXT

    language_code = "es"
    document = {
        "content": text_content,
        "type_": document_type_in_plain_text,
        "language_code": language_code,
    }

    encoding_type = language_v2.EncodingType.UTF8

    response = client.analyze_entities(
        request={"document": document, "encoding_type": encoding_type}
    )

    for entity in response.entities:
        entity_body = {
                "name": entity.name,
                "type_": entity.type_,
                "metadata": [],
                "mentions": []
        }

        entity_body["metadata"].append(dict(entity.metadata))

        for mention in entity.mentions:
            entity_body["mentions"].append({
                "content": mention.text.content,
                "begin_offset": mention.text.begin_offset,
                "probability": mention.probability
            })

        json_response.append(entity_body)

    print(json.dumps(json_response, ensure_ascii=False, indent=4))

# %%

if (len(arguments) > 1 and len(arguments[1]) > 0):
    sample_analyze_entities(plain_text)
else:
    print([])
