from flask import Flask, render_template, jsonify
import mysql.connector

app = Flask(__name__)

@app.after_request
def add_cors_header(response):
    response.headers['Access-Control-Allow-Origin'] = '*'
    return response

@app.route('/song/<song>')
def index(song):
    # Connect to the MySQL database
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="music"
    )

    # Create a cursor object to execute SQL queries
    cursor = mydb.cursor()

    # Execute the SQL query
    cursor.execute("SELECT * FROM song where lyrics like %s",('%'+song+'%',))
    result = cursor.fetchall()
    # Close the cursor and the database connection
    cursor.close()
    mydb.close()
    songs = []
    for row in result:
        song = {
            # 'lyrics': row[0],
            'path': row[1],
            # 'artist': row[2],
            # Add more columns as needed
        }
        songs.append(song)

    # Return the songs as JSON response
    return jsonify(songs)
    # Render the template with the data
    return render_template('index.html', result=result)

if __name__ == '__main__':
    app.run(host='0.0.0.0',port=9005)
