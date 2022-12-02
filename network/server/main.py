#!/usr/bin/python3
from dotenv import load_dotenv
from os import environ
from database import Database
from datetime import datetime
import socket

def log(message):
	print(message)
	with open('logs.txt', 'a') as logs:
		logs.write(f'{datetime.now().strftime("%H:%M:%S")} : {message}\n')

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
		log('failed connecting to the database.')
		log(f'error : {ex}')
		exit()
	log('connected to database successfully.')

	# load environement variables of the socket
	sock_host = environ.get('SOCK_HOST')
	sock_port = environ.get('SOCK_PORT') or 65432
	sock_port = int(sock_port)

	try:
		sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		sock.bind((sock_host, sock_port))
		sock.listen()
	except Exception as ex:
		log('failed creating a socket stream.')
		log(f'error : {ex}')
		exit()
	log('socket stream instantiated successfully.')
	log('listenning...')

	while True:
		conn, addr = sock.accept()
		log(f"Connected by {addr}")

		try:
			while data := conn.recv(1024):
				numero_porte, numero_carte = data.decode().split(',')
				numero_porte = int(numero_porte)
				numero_carte = int(numero_carte)
				verif = db.verifier(numero_carte, numero_porte)
				conn.sendall(bytes(str(verif).encode(encoding='utf-8')))
		except Exception as ex:
			log(f'error : {ex}')
			conn.close()
			break