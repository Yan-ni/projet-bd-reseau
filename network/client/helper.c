#ifndef __HELPER__H__
#define __HELPER__H__

#include<stdio.h>

int ask_number(char* str)
{
	int number, ret = 0;

	do {
		printf("%s", str);
		ret = scanf("%d", &number);
	} while(ret != 1);

	return number;
}

#endif