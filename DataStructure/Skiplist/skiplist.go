package main

import (
	"fmt"
	"math/rand"
)

const MAX_LEVEL = 32

type SkipNode struct {
	key     int
	value   string
	forward []*SkipNode
}

type SkipList struct {
	length int
	header *SkipNode
	tail   *SkipNode
	level  int
}

func NewSkipNode() *SkipNode {
	return &SkipNode{forward: make([]*SkipNode, MAX_LEVEL)}
}

func (skiplist *SkipList) MakeSkipNode(key int, value string) *SkipNode {
	newNode := NewSkipNode()
	newNode.key = key
	newNode.value = value

	return newNode
}

func NewSkipList() *SkipList {
	newskl := &SkipList{}

	newskl.length = 0
	newskl.header = NewSkipNode()
	newskl.tail = nil
	newskl.level = 1
	i := 0
	for i < MAX_LEVEL {
		newskl.header.forward[i] = nil
		i++
	}

	return newskl
}

func (skiplist *SkipList) Insert(key int, value string) *SkipNode {
	update := make([]*SkipNode, MAX_LEVEL)
	tmp := skiplist.header
	i := skiplist.level
	for i >= 0 {
		for tmp.forward[i] != nil && tmp.forward[i].key < key {
			tmp = tmp.forward[i]
		}
		update[i] = tmp
		i--
	}
	tmp = tmp.forward[0]
	if tmp != nil && tmp.key == key {
		tmp.value = value
		return tmp
	} else {
		newLvl := skiplist.RandomLevel()
		if newLvl > skiplist.level {
			i := skiplist.level + 1
			for i < newLvl {
				update[i] = skiplist.header
				i++
			}
			skiplist.level = newLvl
		}
		tmp := skiplist.MakeSkipNode(key, value)
		i := 0
		for i < newLvl {
			tmp.forward[i] = update[i].forward[i]
			update[i].forward[i] = tmp
			i++
		}
		skiplist.length++
	}

	return tmp
}

func (this *SkipList) GetLength() int {
	return this.length
}

func (skiplist *SkipList) Search(key int) (string, int) {
	if skiplist.GetLength() == 0 {
		return "", 0
	}
	x := skiplist.header
	for i := skiplist.level; i > 1; i-- {
		for x.forward[i].key < key {
			x = x.forward[i]
		}
	}

	x = x.forward[1]
	if x.key == key {
		return x.value, 1
	} else {
		return "", 0
	}
}

func (*SkipList) RandomLevel() int {
	level := 1
	val := rand.Float64()

	for val < 0.25 {
		level++
		val = rand.Float64()
		fmt.Println(val)
	}

	if level < MAX_LEVEL {
		return level
	} else {
		return MAX_LEVEL
	}
}

func (skiplist *SkipList) Delete(key int) {
	update := make([]SkipNode, MAX_LEVEL)
	tmp := skiplist.header

	i := skiplist.level
	for i > 1 {
		if tmp.forward[i].key < key {
			tmp = tmp.forward[i]
		}
		i--
	}
	tmp = tmp.forward[1]
	if tmp.key == key {
		i := 1
		for i < skiplist.level {
			if update[i].forward[i] == tmp {
				break
			} else {
				update[i].forward[i] = tmp.forward[i]
			}
			i++
		}
	}
}

func main() {
	skiplist := NewSkipList()
	key1 := 1
	value1 := "apple"

	key2 := 2
	value2 := "banana"

	key3 := 3
	value3 := "cat"

	key4 := 4
	value4 := "dog"

	key5 := 5
	value5 := "egg"

	key6 := 6
	value6 := "fruit"

	skiplist.Insert(key1, value1)
	skiplist.Insert(key2, value2)
	skiplist.Insert(key3, value3)
	skiplist.Insert(key4, value4)
	skiplist.Insert(key5, value5)
	skiplist.Insert(key6, value6)

	fmt.Println(skiplist)
	x := skiplist.header
	for x.forward[0] != nil {
		fmt.Println(x.key)
		fmt.Println(x.value)
		x = x.forward[0]
	}
}
