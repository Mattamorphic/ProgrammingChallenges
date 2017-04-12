# /bin/python3

# Challenge 1 : Sum of multiples - using arithmetic progression process
# author <mfmbarber@gmail.com

import itertools # we'll need the unique combinations of multiples

'''
    Calculate the sum of all multiples in a given total
    Divide total by multiples to get the amount of multiples.
    Then multiply this by the total plus the multiple and divie the result
    by 2

    :param int  multiple    The multiples to search for
    :param int  total       The total to derive the multiples from

    :return int
'''
def calculateSumOfMultiples(multiple, total):
    multiples = (total // multiple)
    return (multiples * ((multiples * multiple) + multiple) // 2)

'''
    Derive the greatest common devisor from two numbers

    :param int a    The first number
    :param int b    The second number

    :return int
'''
def gcd(a, b):
    while b:
        a, b = b, a % b
    return a

'''
    Derive the lowest common multiplier from two numbers

    :param int a    The first number
    :param int b    The second number

    :return int
'''
def lcm(a, b):
    return a * b // gcd(a, b)

'''
    Find the sum of all multiples up to a limit

    :param int  limit       The limit to derive our multiples from
    :param list multiples   The multiples to sum

    :return int
'''
def sumMultiples(limit, multiples):
    # for each multiple in multiples calculate the sum of the multiples from the total
    # and remove all combinations of the lowest common divisor of 2 values from the total
    return reduce(
        lambda x, y: x + y,
        [calculateSumOfMultiples(multiple, limit) for multiple in multiples]
    ) - (reduce(
        lambda x, y: x + y,
        [calculateSumOfMultiples(lcm(m, om), limit) for m, om in itertools.combinations(multiples, 2)]
    ) if len(multiples) > 1 else 0)
