#!/usr/bin/python3
from dotenv import load_dotenv
from os import environ
from database import Database
import socket

if __name__ == '__main__':
	# load environement variables of the database
	load_dotenv()
	db_host = environ.get('DB_HOST')
	db_name = environ.get('DB_NAME')
	db_username = environ.get('DB_USERNAME')
	db_password = environ.get('DB_PASSWORD')

	try:
		db = Database(db_host, db_name, db_username, db_password)
	except Exception as ex:
		print('failed connecting to the database.')
		print(f'error : {ex}')
		exit()
	print('connected to database successfully.')

	# load environement variables of the socket
	sock_host = environ.get('SOCK_HOST')
	sock_port = environ.get('SOCK_PORT')
	sock_port = int(sock_port)

	try:
		sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		sock.bind((sock_host, sock_port))
		sock.listen()
	except Exception as ex:
		print('failed creating a socket stream.')
		print(f'error : {ex}')
		exit()
	print('socket stream instantiated successfully.')
	print('listenning...')

	while True:
		conn, addr = sock.accept()
		print(f"Connected by {addr}")

		try:
			while data := conn.recv(1024):
				numero_porte, numero_carte = data.decode().split(',')
				numero_porte = int(numero_porte)
				numero_carte = int(numero_carte)
				verif = db.verifier(numero_carte, numero_porte)
				conn.sendall(bytes(str(verif).encode(encoding='utf-8')))
		except Exception as ex:
			print(f'error : {ex}')
			conn.close()
			break