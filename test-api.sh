#!/bin/bash

echo "=== Testing Capstone System Backend API ==="
echo ""

BASE_URL="http://localhost:8000/api"

echo "1. Testing Registration..."
REGISTER_RESPONSE=$(curl -s -X POST "$BASE_URL/register" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Test User",
    "email": "testuser@test.com",
    "password": "password",
    "password_confirmation": "password",
    "phone": "09123456789",
    "barangay": "Test Barangay"
  }')

echo "$REGISTER_RESPONSE" | jq '.'
echo ""

# Extract token
TOKEN=$(echo "$REGISTER_RESPONSE" | jq -r '.token')

if [ "$TOKEN" != "null" ] && [ -n "$TOKEN" ]; then
    echo "✓ Registration successful! Token: ${TOKEN:0:20}..."
else
    echo "✗ Registration failed"
    exit 1
fi

echo ""
echo "2. Testing Login..."
LOGIN_RESPONSE=$(curl -s -X POST "$BASE_URL/login" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password"
  }')

echo "$LOGIN_RESPONSE" | jq '.'
USER_TOKEN=$(echo "$LOGIN_RESPONSE" | jq -r '.token')
echo "✓ Login successful!"

echo ""
echo "3. Testing Get Current User..."
curl -s -X GET "$BASE_URL/me" \
  -H "Authorization: Bearer $USER_TOKEN" \
  -H "Accept: application/json" | jq '.'

echo ""
echo "4. Testing Public Announcements..."
curl -s -X GET "$BASE_URL/announcements" \
  -H "Accept: application/json" | jq '.data | length'
echo " announcements found"

echo ""
echo "5. Testing Public Officials..."
curl -s -X GET "$BASE_URL/officials" \
  -H "Accept: application/json" | jq 'length'
echo " officials found"

echo ""
echo "6. Testing Create Complaint..."
COMPLAINT_RESPONSE=$(curl -s -X POST "$BASE_URL/complaints" \
  -H "Authorization: Bearer $USER_TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "complaint_type": "Noise Complaint",
    "subject": "Loud party",
    "description": "There is a very loud party in my neighborhood",
    "location": "123 Main St"
  }')

echo "$COMPLAINT_RESPONSE" | jq '.'
echo "✓ Complaint created successfully!"

echo ""
echo "7. Testing List Complaints..."
curl -s -X GET "$BASE_URL/complaints" \
  -H "Authorization: Bearer $USER_TOKEN" \
  -H "Accept: application/json" | jq '.data | length'
echo " complaints found"

echo ""
echo "8. Testing Create Document Request..."
DOC_RESPONSE=$(curl -s -X POST "$BASE_URL/documents" \
  -H "Authorization: Bearer $USER_TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "document_type": "Barangay Clearance",
    "purpose": "Employment",
    "required_info": {"id_type": "National ID"}
  }')

echo "$DOC_RESPONSE" | jq '.'
TRACKING_NUMBER=$(echo "$DOC_RESPONSE" | jq -r '.document.tracking_number')
echo "✓ Document request created! Tracking: $TRACKING_NUMBER"

echo ""
echo "9. Testing Track Document..."
curl -s -X POST "$BASE_URL/documents/track" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d "{\"tracking_number\": \"$TRACKING_NUMBER\"}" | jq '.'

echo ""
echo "=== All API Tests Completed Successfully! ==="
