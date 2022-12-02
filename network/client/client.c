#include "client.h"

int create_socket(char* host, int port)
{
	int socket_desc = socket(AF_INET , SOCK_STREAM , 0);
	if (socket_desc == -1)
	{
		printf("could not create socket.\n");
		exit(EXIT_FAILURE);
	}

	struct sockaddr_in server;

	server.sin_addr.s_addr = inet_addr(host);
	server.sin_port = htons(port);
	server.sin_family = AF_INET;

	if (connect(socket_desc, (struct sockaddr *)&server, sizeof(server)) < 0)
	{
		printf("connection to the server failed.\n");
		printf("make sure the server is up and listenning on port : %d\n", port);
		exit(EXIT_FAILURE);
	}

	return socket_desc;
}