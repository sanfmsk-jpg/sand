def has_dangerous_chars(text):
    dangerous = "<>&\"';`|$\\"
    return any(ch in dangerous for ch in text)


try:
    s = input()
except EOFError:
    s = "<script>alert('XSS')</script>"

print(has_dangerous_chars(s))
