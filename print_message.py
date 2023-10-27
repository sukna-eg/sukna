import sys

try:
    # Get the message from the command line argument
    message = 'sasa'

    # Print the message
    print(message)
except Exception as e:
    print("Python error:", str(e), file=sys.stderr)
