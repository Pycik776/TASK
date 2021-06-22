import re

line=""
numbers=[]

def input_line():
    line_1=input("Input your line:")
    return line_1

def upper_first_and_last(line_for_upper):
    try:
        line_for_upper= line_for_upper.capitalize()
        line_for_upper = line_for_upper[:-1] + line_for_upper[-1].upper()
        return line_for_upper
    except:
        print("Невозможно вывести первую и последню букву в верхнем регистре, вы не ввели буквы в строку")
    
def max_number(numbers_list):
    numbers_list_2=[]
    try:
        max_num=max(numbers_list)
        print("Максимальное число:", max_num)
        for i in range(len(numbers_list)):
            x=numbers_list[i]
            if(x!= max_num):
                numbers_list_2.append(x**i)
            else:
                continue
        print("Остальные числа возведенные в степень:",numbers_list_2)
    except:
        print("Максимальное число не может быть найдено, вы не ввели числа в строку")
        

line=input_line()
numbers = re.findall(r"\d+", line)
numbers=[int(i) for i in numbers]
line=re.findall("\D", line)
line_2="".join(line)



print("Числа в строке:" , numbers)
print("Символы в строке:",upper_first_and_last(line_2))
max_number(numbers)