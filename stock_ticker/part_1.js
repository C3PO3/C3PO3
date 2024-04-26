const fs = require('fs');
const readline = require('readline');
const { MongoClient } = require('mongodb');

// MongoDB connection URI
const uri = 'mongodb+srv://liagriffeon:zG2KLn57TAQ65IN6@stock.1k5sojy.mongodb.net';
// Database name
const dbName = 'Stock';
// Collection name
const collectionName = 'PublicCompanies';

// Function to read data from the CSV file
async function readDataFromFile(filename) {
    const data = [];
    const fileStream = fs.createReadStream(filename);
    const rl = readline.createInterface({
        input: fileStream,
        crlfDelay: Infinity
    });

    // Skip the first line
    let isFirstLine = true;

    for await (const line of rl) {
        if (isFirstLine) {
            isFirstLine = false;
            continue; // Skip the first line
        }

        const [company, ticker, price] = line.split(',');
        data.push({ company, ticker, price: parseFloat(price) });
    }

    return data;
}

// Function to insert data into MongoDB
async function insertDataIntoDB(data) {
    const client = new MongoClient(uri);

    try {
        await client.connect();
        const db = client.db(dbName);
        const collection = db.collection(collectionName);
        await collection.insertMany(data);
        console.log('Data added successfully!');
    } catch (error) {
        console.error('Error inserting data:', error);
    } finally {
        await client.close();
    }
}

// Main function to execute the program
async function main() {
    try {
        // Read data from CSV file
        const filename = 'companies-1.csv';
        const data = await readDataFromFile(filename);

        // Insert data into MongoDB
        await insertDataIntoDB(data);
    } catch (error) {
        console.error('Error:', error);
    }
}

// Execute the main function
main();
