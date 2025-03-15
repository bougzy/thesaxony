
const express = require('express');
const router = express.Router();
const multer = require('multer');
const path = require('path');
const Donation = require('../models/donation');
const Subscriber = require('../models/subscriber');
const ContactMessage = require('../models/contactMessage');

// Set up multer for file uploads
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, 'public/uploads');
  },
  filename: (req, file, cb) => {
    cb(null, Date.now() + path.extname(file.originalname));
  }
});
const upload = multer({ storage: storage });

// Route to handle donation form submission
router.post('/submit', upload.single('image'), async (req, res) => {
  try {
    const newDonation = new Donation({
      image: '/uploads/' + req.file.filename,
      text: req.body.text
    });
    await newDonation.save();
    res.redirect('/');
  } catch (error) {
    res.status(500).send(error);
  }
});

// Route to get all donations (for homepage)
router.get('/donations', async (req, res) => {
  try {
    const donations = await Donation.find();
    res.json(donations);
  } catch (error) {
    res.status(500).send(error);
  }
});

// Route to handle subscription form submission
router.post('/subscribe', async (req, res) => {
  try {
    const newSubscriber = new Subscriber({
      email: req.body.subscribeEmail
    });
    await newSubscriber.save();
    res.status(201).send('Subscription successful!');
  } catch (error) {
    res.status(500).send(error);
  }
});

// Route to handle contact form submission
router.post('/contact', async (req, res) => {
  try {
    const newContactMessage = new ContactMessage({
      name: req.body.name,
      email: req.body.email,
      message: req.body.message
    });
    await newContactMessage.save();
    res.status(201).send('Message sent successfully!');
  } catch (error) {
    res.status(500).send(error);
  }
});

module.exports = router;

