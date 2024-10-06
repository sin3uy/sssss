const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');

const app = express();
const port = 3000;

// تمكين CORS للسماح بطلبات من أي مصدر
app.use(cors());

// تمكين معالجة JSON
app.use(express.json());

// الاتصال بقاعدة بيانات MongoDB
mongoose.connect('mongodb://localhost:27017/articles', {
    useNewUrlParser: true,
    useUnifiedTopology: true
});

// إنشاء نموذج مقال
const articleSchema = new mongoose.Schema({
    content: String
});

const Article = mongoose.model('Article', articleSchema);

// مسار لاسترجاع جميع المقالات
app.get('/articles', async (req, res) => {
    const articles = await Article.find();
    res.json(articles);
});

// مسار لإرسال مقال جديد
app.post('/articles', async (req, res) => {
    const newArticle = new Article({
        content: req.body.content
    });
    await newArticle.save();
    res.json(newArticle);
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
