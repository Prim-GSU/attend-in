from WAEParser import parser

def eval_expression(tree):
  if tree[0] == 'num':
    return tree[1]
  elif tree[0] == 'id':
    return 'ERROR'
  elif tree[0] == '+' or tree[0] == '-' or tree[0] == '*' or tree[0] == '/':
    v1 = eval_expression(tree[1])
    if v1 == 'ERROR':
      return 'ERROR'
    v2 = eval_expression(tree[2])
    if v2 == 'ERROR':
      return 'ERROR'
    if tree[0] == '+':
      return v1+v2
    elif tree[0] == '-':
      return v1-v2
    elif tree[0] == '*':
      return v1*v2
    elif v2 != 0:
      return v1/v2
    else:
      return 'ERROR'
  elif tree[0] == 'if':
    v1 = eval_expression(tree[1])
    if v1 == 'ERROR':
      return 'ERROR'
    if v1 != 0:
      return eval_expression(tree[2])
    else:
      return eval_expression(tree[3])
  elif tree[0] =='with':
    #exit condition
    if(len(tree[1]) == 2 and tree[1][0][0] == 'id' and  tree[1][1][0] =='num' and len(tree[2]) == 3):
        reduced_exp = replace_Ids(tree[1:])
        return ['num',eval_expression(reduced_exp)]  
    else:
        while tree[0] == 'with' and tree[1][1][0] == 'with':
            print('before: ',tree)
            tree[1][1] = eval_expression(tree[1][1])
            print('after reduction:',tree)
        #after while loop is done only one with is left
        #do the eval again
        tree = eval_expression(tree)
        #print('asasdasd:', tree)
        return tree
    
'''
Input: tree after the with of type [[['id', 'y'], ['num', 3.0]], ['+', ['id', 'y'], ['id', 'y']]]
I'm replaceing the lists in the second lists with the id's 
'''
def replace_Ids(tree):
    old_list = tree[0][0]
    #print('old list',old_list)
    new_list = ['num',tree[0][1][1]]
    #print('new_list', new_list)
    for i in range(0,len(tree[1])):
        if tree[1][i] == old_list:
            tree[1][i] = new_list

    return tree[1]    

def read_input():
  result = ''
  while True:
    data = input('WAE: ').strip() 
    if ';' in data:
      i = data.index(';')
      result += data[0:i+1]
      break
    else:
      result += data + ' '
  return result

def main():
  while True:
    data = read_input() 
    if data == 'exit;':
      break
    try:
      tree = parser.parse(data)
      print(tree)
    except Exception as inst:
      print(inst.args[0])
      continue
    #print(tree)
    try:
      answer = eval_expression(tree)
      if isinstance(answer,list):
          answer = answer[1]
      if answer == 'ERROR':
        print('\nEVALUATION ERROR\n')
      else:
        print('\nThe value is '+str(answer)+'\n')
    except:
      pass
 
main()
