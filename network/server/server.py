import socket

HOST = "127.0.0.1"
PORT = 65432

class server:
	def __init__(self):
		with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as sock:
			sock.bind((HOST, PORT))
			sock.listen()

			print(f'listenning on {HOST}:{PORT}')

			while True:
				conn, addr = sock.accept()

				with conn:
					print(f"Connected by {addr}")

					while True:
						data = conn.recv(1024)
						if not data:
							break
						# conn.sendall(data)
