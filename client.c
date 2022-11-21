#include<stdio.h>
#include<string.h>	//strlen
#include<sys/socket.h>
#include<arpa/inet.h>	//inet_addr
#define HOST "127.0.0.1"
#define PORT 65432


int main(int argc , char *argv[])
{
	int socket_desc;
	struct sockaddr_in server;
	
	//Create socket
	socket_desc = socket(AF_INET , SOCK_STREAM , 0);
	if (socket_desc == -1) printf("Could not create socket");

	server.sin_addr.s_addr = inet_addr(HOST);
	server.sin_port = htons(PORT);
	server.sin_family = AF_INET;

	//Connect to remote server
	if (connect(socket_desc , (struct sockaddr *)&server , sizeof(server)) < 0)
	{
		printf("connect error");
		return 1;
	}
	
	printf("Connected\n");

    char *message;
	message = "";
	if( send(socket_desc , message , strlen(message) , 0) < 0)
	{
		printf("Send failed");
		return 1;
	}
	printf("Data Send\n");
	
	return 0;
}