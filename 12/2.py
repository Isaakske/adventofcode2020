import os

# get the location of the current script
__location__ = os.path.realpath(os.path.join(os.getcwd(), os.path.dirname(__file__)))

fi = open(os.path.join(__location__, 'input.txt'))
inputString = fi.read()
inputArray = inputString.split('\n')

shipX = 0
shipY = 0
x = 10
y = 1

for instruction in inputArray:
    data = list(instruction)
    action = data[0]
    value = int(''.join(data[1:]))

    if (action == 'L'):
        action = 'R'
        value = 360 - value

    if (action == 'N'):
        y += value
    elif (action == 'E'):
        x += value
    elif (action == 'S'):
        y -= value
    elif (action == 'W'):
        x -= value
    elif (action == 'R'):
        for i in range(int(value / 90)):
            oldX = x
            oldY = y
            
            x = oldY
            y = -oldX
    elif (action == 'F'):
        shipX += (x * value)
        shipY += (y * value)

print(abs(shipX) + abs(shipY))
