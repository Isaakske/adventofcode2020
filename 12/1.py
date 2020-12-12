import os

# get the location of the current script
__location__ = os.path.realpath(os.path.join(os.getcwd(), os.path.dirname(__file__)))

fi = open(os.path.join(__location__, 'input.txt'))
inputString = fi.read()
inputArray = inputString.split('\n')

x = 0
y = 0
degrees = 0

def directionForDegrees (degrees):
    if (degrees == 0):
        return 'E'
    elif (degrees == 90):
        return 'S'
    elif (degrees == 180):
        return 'W'
    elif (degrees == 270):
        return 'N'

for instruction in inputArray:
    data = list(instruction)
    action = data[0]
    value = int(''.join(data[1:]))

    if (action == 'L'):
        degrees -= value
        if (degrees < 0):
            degrees += 360
        continue
    elif (action == 'R'):
        degrees += value
        if (degrees >= 360):
            degrees -= 360
        continue

    if (action == 'F'):
        action = directionForDegrees(degrees)

    if (action == 'N'):
        y += value
    elif (action == 'E'):
        x += value
    elif (action == 'S'):
        y -= value
    elif (action == 'W'):
        x -= value

print(abs(x) + abs(y))
