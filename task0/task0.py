import random
n = [random.randint(-100, 100) for x in range(30)]
largest_number = max(n)
n.index(largest_number)
print(n)
print(largest_number)
print(n.index(largest_number)+1)
for i in range(29):
  if n[i]<0 and n[i+1]<0:
    print(n[i],n[i+1])