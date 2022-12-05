
SRC_DIR = .
BUILD_DIR = build
GXX = gcc

build:
	@mkdir -p $(BUILD_DIR)
	@echo "Compliling .c files ..."
	@$(GXX) $(SRC_DIR)/*.c -o $(BUILD_DIR)/main

clean:
	@echo "Cleaning..."
	@rm -r $(BUILD_DIR)
	@echo "Cleaning succesfull!"

run: $(BUILD_DIR)/main
	@echo "Running the main program..."
	@$(BUILD_DIR)/main

.PHONY: build