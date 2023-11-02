import requests

def is_proxy_working(proxy_url):
    try:
        response = requests.get(proxy_url)
        if response.status_code == 200:
            return True
        else:
            return False
    except:
        return False

def create_proxy_file(proxy_url):
    with open('proxies.txt', 'a') as f:
        f.write(proxy_url + '\n')

def read_proxy_list(proxy_list_file):
    with open(proxy_list_file, 'r') as f:
        return f.readlines()

if __name__ == '__main__':
    proxy_list = read_proxy_list('proxy_list.txt')
    for proxy in proxy_list:
        proxy = proxy.strip()
        if is_proxy_working(proxy):
            create_proxy_file(proxy)
            print('Proxy {} is working and has been added to the file proxies.txt!'.format(proxy))
