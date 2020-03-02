require('dotenv').config()
const mariadb = require('mariadb');
const axios = require('axios');

const pool = mariadb.createPool({
	host: process.env.DB_HOST,
	user: process.env.DB_USERNAME,
	password: process.env.DB_PASSWORD,
	database: process.env.DB_DATABASE,
	proconnectionLimit: 5
});

pool.getConnection()
  .then(conn => {

  	setInterval( async () => {
  		let rows = (await conn.query('SELECT * from episodes where status = "uploading" '))
	  	for (item of rows) {
				let drive = getDriveId(item.drive)
				let lStream = (await axios.get('http://116.203.155.21:8028/getLinkStream?file=downloaded.'+drive+'.mp4')).data
				if (lStream.length > 0 ) {
					await conn.query('UPDATE episodes SET status="uploaded" WHERE id='+item.id)
					//console.log('upload complete' + item.id)
				}
				else {
					//console.log('continue upload')
				}	
	  	}
  	},30000)
  	   
  })
  .catch(err => {
    console.log("Can't connect to database");
  });


function getDriveId (drive_url) {
	let regex = /^https\:\/\/drive\.google\.com\/file\/d\/(.*)\//
	let matches = drive_url.match(regex)
	return matches[1];
}


