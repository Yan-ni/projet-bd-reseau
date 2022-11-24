import psycopg
from psycopg.rows import dict_row
from dotenv import load_dotenv
from os import environ
import json

class Database:
	def __init__(self, host, name, username, password):
		# connect to the database
		db_connection_string = f'host={host} dbname={name} user={username} password={password}'
		db_connection = psycopg.connect(db_connection_string)
		self.cur = db_connection.cursor(row_factory=dict_row)

	def verifier(self, numero_carte: str, numero_porte:str) -> int:
		self.cur.execute('SELECT * FROM carte WHERE numero_carte = %s', (numero_carte,))
		carte = self.cur.fetchone()

		if carte is None:
			return 1

		self.cur.execute('SELECT * FROM porte WHERE numero_porte = %s', (numero_porte,))
		porte = self.cur.fetchone()
		
		if porte is None:
			return 2

		if carte.get('perdu'):
			return 3
		
		if carte.get('numero_porte') != porte.get('numero_porte'):
			return 4

		return 0

