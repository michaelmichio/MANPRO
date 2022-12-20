import express from "express";
import mysql from "mysql";
import path from "path";
const app = express();

app.use(express.static(path.resolve('public')));

app.set("view engine", "ejs");

const pool = mysql.createPool({
    host:'localhost',
    user : 'root',
    password:'',
    database: 'game of thrones',
    connectionLimit: 10
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
    res.render('index')
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

const cariKarakterYangBerinteraksi = (conn,masukan) => {
    return new Promise((resolve, reject) => {
        conn.query(
            'SELECT target,weight FROM interaksi WHERE book=? AND source LIKE ? GROUP BY target LIMIT ?,?',
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
const JumlahKarakterYangBerinteraksi = (conn,masukan) => {
    return new Promise((resolve, reject) => {
        conn.query(
            'SELECT COUNT(target) as count FROM interaksi WHERE book=? AND source LIKE ? ',
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

app.get('/search/', async(req, res) => {
    if(req.query.Buku!=undefined && req.query.Karakter!=undefined && req.query.start!=undefined){
        const conn = await dbConnect();
        const Karakter='%'+req.query.Karakter+'%'
        const start = parseInt(req.query.start)
        const stop = 10
        const masukan1 = [req.query.Buku,Karakter,start,stop]
        const masukan2 = [req.query.Buku,Karakter]
        const hasil = await cariKarakterYangBerinteraksi(conn,masukan1);
        const jumlah = await JumlahKarakterYangBerinteraksi(conn,masukan2);
        const berapaHalaman = Math.ceil(jumlah[0].count/10)
        res.render('search',{
            Buku:req.query.Buku,
            Karakter:req.query.Karakter,
            hasil,
            jumlah,
            start,
            stop,
            berapaHalaman
        })
    }
    else{
        res.render('search',{
            Buku:undefined,
            Karakter:undefined,
            hasil:undefined,
            start:undefined
        })
    } 
    
    
})

app.get('/graph', async(req, res) => {
    res.render('graph')
})

app.listen(8080);
