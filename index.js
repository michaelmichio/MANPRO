import express from "express";
import mysql from "mysql"
import path from "path";
const app = express();

app.use(express.static(path.resolve('public')));

app.set("view engine", "ejs");

const pool = mysql.createPool({
    host:'localhost',
    user : 'root',
    password:'',
    database: 'game of thrones',
    connectionLimit:10
})

const dbConnect = () => {
    return new Promise((resolve, reject) => {
        pool.getConnection((err, conn) => {
            if(err) {
                reject(err);
            }
            else {
                resolve(conn);
            }
        })
    })
}

const cariTopTenKarakter = (conn, masukan) => {
    return new Promise((resolve, reject) => {
        conn.query(
            'SELECT source,sum(weight) as weight FROM interaksi WHERE book=? GROUP BY source ORDER BY sum(weight) DESC LIMIT 10',
            masukan,
            (err, result) => {
                if(err) {
                    reject(err);
                }
                else {
                    resolve(result);
                }
            }
        )
    })
}

app.get('/', async(req, res) => {
    res.sendFile('index.html', {root:'.'});
})

app.get('/GrafikBar/', async(req, res) => {
    const conn = await dbConnect();
    const hasil = await cariTopTenKarakter(conn, req.query.Buku);
    const contoh = "A";
    res.render('GrafikBar', {
        hasil,
        buku:req.query.Buku
    })
})

app.listen(8080);
